<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feedback
 * @property string $message
 * @property string $filePath
 * @package App\Models
 */
class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = ['message', 'file_path'];

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->file_path;
    }
}
