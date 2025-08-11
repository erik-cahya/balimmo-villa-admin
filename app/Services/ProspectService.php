<?php
namespace App\Services;

use App\Models\PropertyLeadsModel;
use App\Models\PropertyProspectModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProspectService {

    
    /**
     * Membuat prospect baru dari leads
     * @param PropertyLeadsModel[] $leads
     */

    public function createNewProspect(string $customerID , Collection $leadsModel) : Collection
    {
       $prospects = collect();
        foreach ($leadsModel as $lead) {
            $prospect = PropertyProspectModel::create([
                'properties_id' => $lead->properties_id,
                'land_id' => $lead->land_id,
                'customer_id' => $lead->customer_id,
                'type_asset' => $lead->type_asset,
                'min_budget_idr' => $lead->min_budget_idr,
                'max_budget_idr' => $lead->max_budget_idr,
                'min_budget_usd' => $lead->min_budget_usd,
                'max_budget_usd' => $lead->max_budget_usd,
                'min_bedroom' => $lead->min_bedroom,
                'max_bedroom' => $lead->max_bedroom,
                'min_land_size' => $lead->min_land_size,
                'max_land_size' => $lead->max_land_size,
                'localization' => $lead->localization,
                'date' => $lead->date,
                'status' => 'new prospect'
            ]);

            // Menambahkan asset ke selected asset pada prospect
            if(!is_null($prospect->land_id)) 
            {
                $prospect->landSelected()->create(['land_id' => $prospect->land_id]);
            } 
            
            else if (!is_null($prospect->properties_id)) 
            {
                $prospect->propertySelected()->create(['properties_id' => $prospect->properties_id]);
            }

            $prospects->add($prospect);
        }

        //Menghapus data leads
        PropertyLeadsModel::where('customer_id', $customerID)->delete();
        return $prospects;
        
    }

    public function addAssetToProspectSelected(PropertyProspectModel $prospect , array $asset_ids) : Model | null
    {
        $selected_properties = null;

        if($prospect->type_asset == 'land') 
        {
            foreach($asset_ids as $land_id) {
                $prospect->landSelected()->updateOrCreate(
                    [
                        'prospect_id' => $prospect->id,
                        'land_id' => $land_id
                    ] , 
                    ['land_id' => $land_id]
                );
            }
        } 
        
        else if ($prospect->type_asset == 'properties') 
        {
            foreach($asset_ids as $properties_id) {
                $prospect->propertySelected()->updateOrCreate(
                    [
                        'prospect_id' => $prospect->id,
                        'properties_id' => $properties_id
                    ] , 
                    ['properties_id' => $properties_id]
                );
            }
        }

        return $selected_properties;
    }

}