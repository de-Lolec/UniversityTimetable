<?php

namespace App\Observers;

use App\Models\Timetable;

use Carbon\Carbon;

class TimetableObserver
{
    /**
     * Handle the BlogPost "created" event.
     *
     * @param Timetable $timetable
     * @return void
     */
    public function created(Timetable $timetable)
    {
        //
    }

    public function creating(Timetable $timetable)
    {
        $this->setPublishedAt($timetable);

        $this->setSlug($timetable);

        $this->setHtml($timetable);


    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updating(Timetable $timetable)
    {

        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

    }

/**
*
*
* @param Timetable $timetable
*/


    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost['slug'])) {
            $blogPost['slug'] = \Str::slug($blogPost['title']);
        }
    }



   protected function setPublishedAt(Timetable $blogPost)
{
//        $needSetPublished = (empty($blogPost->published_at)
//            && $blogPost->is_published);


        if(empty($blogPost->published_at) && $blogPost['is_published']) {
            $blogPost['published_at'] = Carbon::now();
        }

//    if (empty($item->published_at) && $data['is_published']) {
//        $data['published_at'] = Carbon::now();
//    }
}

    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost['slug'])) {
            $blogPost['slug'] = \Str::slug($blogPost['title']);
        }
    }

    /*
     * Установка значения полю content_html относительно поля content_raw
     *
     * @param BlogPost $blogPost
     */

    protected function setHtml(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')){
            // TODO: Тут должна быть генерация markdown -> html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /*
     * Если не указан user_id, то устанавливаем пользователя по-умолчанию
     *
     * @param BlogPost $blogPost
     */
    protected function setUser(BlogPost $blogPost){
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the BlogPost "deleting" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleting(BlogPost $blogPost)
    {
        //return false;
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }




}
