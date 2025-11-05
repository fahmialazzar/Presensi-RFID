<?php

namespace App\Models;

class UploadModel extends BaseModel
{
    protected $jpgQuality;
    protected $webpQuality;
    protected $imgExt;

    public function __construct()
    {
        parent::__construct();
        $this->jpgQuality = 85;
        $this->webpQuality = 80;
        $this->imgExt = '.jpg';
    }

    //upload file
    private function upload($inputName, $directory, $namePrefix, $allowedExtensions = null)
    {
        if ($allowedExtensions != null && is_array($allowedExtensions) && !empty($allowedExtensions[0])) {
            if (!$this->checkAllowedFileTypes($inputName, $allowedExtensions)) {
                return null;
            }
        }
        $file = $this->request->getFile($inputName);
        if (!empty($file) && !empty($file->getName())) {
            $orjName = $file->getName();
            $name = pathinfo($orjName, PATHINFO_FILENAME);
            $ext = pathinfo($orjName, PATHINFO_EXTENSION);
            $uniqueName = $namePrefix . generateToken(true) . '.' . $ext;
            if (!$file->hasMoved()) {
                if ($file->move(FCPATH . $directory, $uniqueName)) {
                    return ['name' => $uniqueName, 'orjName' => $orjName, 'path' => $directory . $uniqueName, 'ext' => $ext];
                }
            }
        }
        return null;
    }

    //upload temp file
    public function uploadTempFile($inputName, $isImage = false)
    {
        $allowedExtensions = array();
        if ($isImage) {
            $allowedExtensions = ['jpg', 'jpeg', 'webp', 'png', 'gif'];
        }
        return $this->upload($inputName, 'uploads/tmp/', 'temp_', $allowedExtensions);
    }

    //logo upload
    public function uploadLogo($inputName)
    {
        return $this->upload($inputName, "uploads/logo/", "logo_", ['jpg', 'jpeg', 'png', 'gif', 'svg']);
    }

     //upload CSV file
    //  public function uploadCSVFile($inputName)
    //  {
    //      return $this->upload($inputName, 'uploads/tmp/', 'temp_', ['csv']);
    //  }

    //check allowed file types
    public function checkAllowedFileTypes($fileName, $allowedTypes)
    {
        if (!isset($_FILES[$fileName])) {
            return false;
        }
        if (empty($_FILES[$fileName]['name'])) {
            return false;
        }

        $ext = pathinfo($_FILES[$fileName]['name'], PATHINFO_EXTENSION);
        if (!empty($ext)) {
            $ext = strtolower($ext);
        }
        $extArray = array();
        if (!empty($allowedTypes) && is_array($allowedTypes)) {
            foreach ($allowedTypes as $item) {
                if (!empty($item)) {
                    $item = trim($item, '"');
                }
                if (!empty($item)) {
                    $item = trim($item, "'");
                }
                array_push($extArray, $item);
            }
        }
        if (!empty($extArray) && in_array($ext, $extArray)) {
            return true;
        }
        return false;
    }


    public function generateCSVObjectPost()
{
    try {
        $uploadModel = new UploadModel();
        // Delete old txt files
        $files = glob(FCPATH . 'uploads/tmp/*.txt');
        if (!empty($files)) {
            foreach ($files as $item) {
                @unlink($item);
            }
        }

        $file = $uploadModel->uploadCSVFile('file');
        if (!empty($file) && !empty($file['path'])) {
            // Log file path sementara
            log_message('error', 'CSV File Path: ' . $file['path']);

            $obj = $this->generateCSVObject($file['path']);

            if (!empty($obj)) {
                $data = [
                    'result' => 1,
                    'numberOfItems' => $obj->numberOfItems,
                    'txtFileName' => $obj->txtFileName,
                ];
                echo json_encode($data);
                return;
            }
        }

        echo json_encode(['result' => 0]);
    } catch (\Throwable $e) {
        log_message('error', 'CSV Upload Error: ' . $e->getMessage());
        log_message('error', $e->getTraceAsString());
        echo json_encode(['result' => 0, 'message' => 'Internal Server Error']);
    }
}

// Contoh UploadModel yang benar
public function uploadCSVFile($fieldName)
{
    $file = $this->request->getFile($fieldName);
    
    if (!$file || !$file->isValid()) {
        return null;
    }
    
    $newName = $file->getRandomName();
    $file->move(FCPATH . 'uploads/', $newName);
    
    return [
        'path' => 'uploads/' . $newName,
        'name' => $newName
    ];
}

}
