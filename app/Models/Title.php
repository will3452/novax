<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'faculty_id',
        'no_of_students',
        'area_of_research',
        'ic_type',
        'status', 
        'section_id', 
    ];

    const IC_TYPE_CAPSTONE = 'Capstone';
    const IC_TYPE_THESIS = 'Thesis'; 
    const IC_TYPE_PLANT_DESIGN = 'Plant Design';
    const IC_TYPE_FEASIBILITY_STUDY = 'Feasibility Study'; 
    const IC_TYPE_BUSINESS_PLAN = 'Business Plan'; 

    const STATUS_TAKEN = 'Taken';
    const STATUS_AVAILABLE = 'Available';

    public function faculty () {
        return $this->belongsTo(User::class, 'faculty_id'); 
    }

    public function titleApplications () {
        return $this->hasMany(TitleApplication::class, 'title_id'); 
    }

    public function group () {
        return $this->hasOne(Group::class, 'title_id'); 
    }

    public function section () {
        return $this->belongsTo(Section::class, 'section_id'); 
    }
}
