<?php
namespace App\Services;

use App\Models\PropertyLeadsModel;
use App\Models\PropertyProspectModel;
use Illuminate\Support\Collection;

class LeadsService {

    
    /**
     * Membuat prospect baru dari leads
     * @param PropertyLeadsModel[] $leads
     */

    public function updateOrCreateLeads(string $customerID , Collection $dataLeads) : Collection
    {
        $leads = collect();

        foreach ($dataLeads as $lead) {
            $type_asset = $lead['type_asset'];

            unset($lead['type_asset']);

            $data = PropertyLeadsModel::updateOrCreate(
                [
                    'customer_id' => $customerID,
                    'type_asset' => $type_asset
                ]    
            , $lead);

            $leads->add($data);
        }

        return $leads;
    }

}