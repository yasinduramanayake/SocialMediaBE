<?php

namespace Modules\ReviewManagement\Repositaries;

use Illuminate\Support\Facades\Storage;
use Modules\ReviewManagement\Entities\contacts;
use Modules\ReviewManagement\Repositaries\ReviewServicesInterfaces;
use Modules\ReviewManagement\Entities\Reviews;
use Modules\UserManagement\Entities\User;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Validation\ValidationException;
use Modules\OrderManagement\Entities\Order;

class ReviewServicesImplements implements ReviewServicesInterfaces
{

    // reviewsstore
    public function create($data)
    {
        $order = Order::where('finalize_order_id', $data['order_id'])->first();
        $review = Reviews::where('order_id', $data['order_id'])->first();
        if ($order != null) {
            if ($review  === null) {
                $datainserted =  Reviews::create($data);
                return $datainserted;
            } else {
                throw ValidationException::withMessages([
                    'error' => "You Have Already Reviewed Before!",
                ], 422);
            }
        } else {
            throw ValidationException::withMessages([
                'error' => "Wrong Order Id ",
            ], 422);
        }
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

    // delete review

    public function delete($id)
    {
        $id->delete();
    }
}
