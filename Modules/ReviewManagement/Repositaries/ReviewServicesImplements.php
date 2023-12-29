<?php

namespace Modules\ReviewManagement\Repositaries;

use Illuminate\Support\Facades\Storage;
use Modules\ReviewManagement\Entities\contacts;
use Modules\ReviewManagement\Repositaries\ReviewServicesInterfaces;
use Modules\ReviewManagement\Entities\Reviews;
use Spatie\QueryBuilder\QueryBuilder;


class ReviewServicesImplements implements ReviewServicesInterfaces
{

    // reviewsstore
    public function create($data)
    {

        $datainserted =  Reviews::create($data);
        return $datainserted;
    }

    // All Reviews
    public function index()
    {
        $reviews = QueryBuilder::for(Reviews::class)
            ->allowedFilters(['service'])
            ->get();

        return  $reviews;
    }

    // store contacts
    public function addcontact($data)
    {
        $image_path = Storage::disk('public')->put('contactfiles', $data['file']);

        $contact = new contacts();

        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->subject = $data['subject'];
        $contact->message = $data['message'];
        $contact->file =  $image_path;

        $contact->save();

        return $contact;
    }
}
