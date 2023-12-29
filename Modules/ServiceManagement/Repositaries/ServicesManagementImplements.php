<?php

namespace Modules\ServiceManagement\Repositaries;

use Exception;
use Modules\ServiceManagement\Entities\Services;
use Modules\ServiceManagement\Repositaries\ServicesManagementInterfaces;
use Spatie\QueryBuilder\QueryBuilder;

use function PHPUnit\Framework\throwException;

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
        if ($data['category'] === "Instagram") {
            $web = new \Spekulatius\PHPScraper\PHPScraper;
            $web->setConfig(['proxy' => 'http://user:password@127.0.0.1:3128']);
            $web->go($data['username']);

            dd($web->title);
            // $scrapData = [
            //     'description' => $web->openGraph['og:description'],
            //     'title' => $web->openGraph['og:title'],
            //     'image' => $web->openGraph['og:image']
            // ];

            // return $scrapData;
        } else {
            throw new Exception('Invalid link service link');
        }
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
