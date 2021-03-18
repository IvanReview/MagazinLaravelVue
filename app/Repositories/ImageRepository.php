<?php


namespace App\Repositories;


class ImageRepository
{


    /**
     *
     * Модификация изображения для пользователя
     *
     * @param $file
     * @return string путь к изображению
     */
    public function modifyImageForUser($file)
    {

        //Получить имя файла
        $fileNameWithExtension = $file->getClientOriginalName();

        //имя файла без расширения
        $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        //расширение файла
        $extension = $file->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = $filename . '_' . uniqid() . '.' .$extension;


        //Resize image here
        $thumbnailPath = storage_path('app/public/user/'.$fileNameToStore);
        $imageInDBPath = 'user/' . $fileNameToStore;

        $img = \Image::make($file);

        $height = $img->height();
        $width = $img->width();
        if($height >= 601) {
            $img->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if($width >= 601) {
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->crop(500, 500)->save($thumbnailPath);

        return $imageInDBPath;

    }
}
