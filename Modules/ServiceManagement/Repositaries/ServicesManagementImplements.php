<?php

namespace Modules\ServiceManagement\Repositaries;

use Modules\ServiceManagement\Entities\Services;
use Modules\ServiceManagement\Repositaries\ServicesManagementInterfaces;
use Spatie\QueryBuilder\QueryBuilder;

class ServicesManagementImplements  implements ServicesManagementInterfaces
{



    // store data
    public function create($data)
    {
        $createdDate =   Services::create($data);
        return response()->json($createdDate);
    }

    // get data by subcategory id

    public function index($data)
    {

        $services = Services::where('subcategory_id', $data['subcategory_id'])->get();

        return  $services;
    }



    public function scraper($data)
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go('https://www.instagram.com/' . $data['username'] . '/');


        $scrapData = [
            'description' => $web->openGraph['og:description'],
            'title' => $web->openGraph['og:title'],
            'image' => $web->openGraph['og:image']
        ];

        return $scrapData;
    }

    // service update
    public function update($id, $data)
    {
        $id->update($data);

        return  $data;
    }

    // service delete
    public function delete($id)
    {
        $status =  $id->delete();

        return  $status;
    }
}
