<?php

namespace Botble\{Module}\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Support\Facades\Storage;
use RvMedia;

class {Name} extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '{-names}';

    /**
     * @var array
     */
    protected $fillable = [
        '{module}_id',
        'name',
        'folder',
        'mime_type',
        'size',
        'url',
        'options',
    ];

    /**
     * Get the {module} that owns the file.
     */
    public function {module}()
    {
        return $this->belongsTo('Botble\{Module}\Models\{Module}', '{module}_id');
    }

    /**
     * @return bool
     */
    public function canGenerateThumbnails(): bool
    {
        return RvMedia::isImage($this->mime_type) &&
            !in_array($this->mime_type, ['image/svg+xml', 'image/x-icon', 'image/gif']) &&
            Storage::exists($this->folder . '/' . $this->url);
    }
}
