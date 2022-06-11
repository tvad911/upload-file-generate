<?php

namespace Botble\LeaseContract\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\LeaseContract\Repositories\Interfaces\LeaseContractFileInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Storage;

class LeaseContractFileRepository extends RepositoriesAbstract implements LeaseContractFileInterface
{
	/**
     * {@inheritdoc}
     */
    public function createName($name, $folder)
    {
        $index = 1;
        $baseName = $name;
        while ($this->checkIfExistsName($name, $folder)) {
            $name = $baseName . '-' . $index++;
        }

        return $name;
    }

    /**
     * {@inheritdoc}
     */
    public function checkIfExistsName($name, $folder)
    {
        $count = $this->model
            ->where('name', $name)
            ->where('folder', $folder)
            ->get();

        /**
         * @var Eloquent $count
         */
        $count = $count->count();

        return $count > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $extension, $folderPath)
    {
        $slug = Str::slug($name);
        $index = 1;
        $baseSlug = $slug;
        while (File::exists(Storage::path(rtrim($folderPath, '/') . '/' . $slug . '.' . $extension))) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = $slug . '-' . time();
        }

        return $slug . '.' . $extension;
    }
}
