<?php

namespace App\Models;

use Database\Factories\FeedbackFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feedback
 * @package App\Models
 */
class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = ['message', 'file'];

    /**
     * for testing
     * @return FeedbackFactory
     */
    protected static function newFactory()
    {
        return FeedbackFactory::new();
    }

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
    public function getFile(): string
    {
        return $this->file;
    }
}
