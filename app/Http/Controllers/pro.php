<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Feature;
use App\Models\course;
use App\Models\laguage;

class pro extends Controller
{
    public function projects()
    {
        $projects = Project::all();
        for ($i = 0; $i < count($projects); $i++) {
            $feature = Feature::where('feature_id', $projects[$i]->id)->get();
            $projects[$i]->feature = $feature;
        }

        return $projects;
    }

    public function drop()
    {
        $down = [];
        $drop = course::all();
        $lan = laguage::all();
        for ($i = 0; $i < count($drop); $i++) {
            array_push($down, $drop[$i]);
        };
        for ($i = 0; $i < count($lan); $i++) {
            array_push($down, $lan[$i]);
        }
        return $down;
    }
}
