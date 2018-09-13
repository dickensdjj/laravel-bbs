<?php

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    // allowed extentsion
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix, $max_width= false)
    {
        // example: uploads/images/avatars/201709/21/
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // /home/vagrant/Code/larabbs/public / uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // add png extentsion when copying from clipboard.
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // example: 1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // 
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // save
        $file->move($upload_path, $filename);

        
        if ($max_width && $extension != 'gif') {

            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            // when uri change should use config(app.url)
            'path' => "http://lproject.test" . "/$folder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 
        $image = Image::make($file_path);

        // 
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 
        $image->save();
    }
}