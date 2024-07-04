<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Support\Facades\Schema;


class Product extends Model
{
    use Slug , SoftDeletes , Loggable;
    protected $vat_percentage = 20; // 20% VAT, adjust as needed

    protected $fillable = [
        'title',
        'slug',
        'image',
        'cat_id',
        'qty',
        'status',
        'product_code',
        'long_description',
        'gross_weight',
        'net_weight',
        'barcode_each',
        'inner_carton_quantity',
        'inner_carton_weight',
        'inner_carton_length',
        'inner_carton_width',
        'inner_carton_height',
        'inner_carton_barcode',
        'middle_carton_quantity',
        'middle_carton_barcode',
        'outer_carton_quantity',
        'outer_carton_weight',
        'outer_carton_length',
        'outer_carton_width',
        'outer_carton_height',
        'outer_carton_volume',
        'outer_carton_barcode',
        'vendor_price',
        'datasheet_url',
        'declaration_of_conformity_ukca',
        'declaration_of_conformity_ce',
        'diameter',
        'length',
        'height',
        'width',
        'depth',
        'projection',
        'recessed_depth',
        'recessed_depth_with_ic_cage',
        'minimum_void',
        'cut_out_diameter',
        'cut_out_with_sleeve',
        'cut_out_box_w_h_d',
        'min_mounting_box_depth',
        'tilt',
        'rotation',
        'construction',
        'construction_two',
        'finish',
        'class',
        'ip_rating',
        'primary_voltage',
        'cable_length',
        'diffuser',
        'emergency',
        'maximum_weight_loading',
        'lamp_technology',
        'lamp_base',
        'lamp_included',
        'dimmable',
        'max_wattage',
        'l70b50',
        'l70b10',
        'energy_rating',
        'beam_angle',
        'cct',
        'light_colour',
        'lumens',
        'lumens_light_source',
        'lumens_em_mode',
        'wattage',
        'efficacy',
        'cri',
        'driver_type',
        'fastcharge',
        'earth_terminal',
        'neon_indicator',
        'tv_connection_type',
        'sat_connection_type',
        'fm_dab_connection_type',
        'terminal',
        'anti_microbial_properties',
        'warranty',
        'line_drawing_one_url',
        'line_drawing_two_url',
        'commodity_code',
        'dismantling_procedure_url',        
        'vendor_id',
        'stock_level',
        'stock_status',
        'uploader_image',
        'specification',
        'pdf',
        'overview',
        'specific_download',
        'dimension_unpacked_height',
        'dimension_unpacked_width',
        'dimension_unpacked_dipth',
        'link',
        "supplier_barcode",
        "colour",
        "catalogue",
        "category_level_1",
        "category_level_2",
        "category_level_3",
        "luckins_code",
        "selling_factor",
        "trade_price",
        "product_barcode",
        "inner_barcode",
        "outer_barcode",
        "product_length",
        "price",
        "vendor_percentage",
    ];

    protected $appends = [
        'price_including_vat'
    ];

    public function category_detail(){
        return $this->belongsTo(Category::class , "cat_id");
    }
    public static function getTableColumns()
    {
        return Schema::getColumnListing((new self())->getTable());
    }

    public function product_to_category(){
        return $this->hasMany(ProductToCategory::class , 'product_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function getPriceIncludingVatAttribute()
    {
        $vatPercentage = $this->vat_percentage / 100;
        return number_format($this->price + ($this->price * $vatPercentage) , 2);
    }
   
}
