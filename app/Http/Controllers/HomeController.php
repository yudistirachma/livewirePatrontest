<?php

namespace App\Http\Controllers;

use App\Content;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {        
        $year = '2021';

        if (auth()->user()->roles[0]->name == "pimpinan redaktur") {
            $late = Content::whereColumn('verification', '>', 'deadline')
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
    
            $notValidated = Content::where('verification', null)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
    
            $validated = Content::where('verification', '!=', null)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
    
            $content = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(created_at) as month"))
            ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
            ->orderBy('created_at')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->all();
        }elseif (auth()->user()->roles[0]->name == "redaktur") {
            $late = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id')
                    ->Where('groups.user_id', '=', auth()->user()->id );
            })
            ->whereColumn('verification', '>', 'deadline')
            ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
            ->count();
            // dd($late);
    
            $notValidated = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id')
                    ->Where('groups.user_id', '=', auth()->user()->id );
            })
            ->where('verification', null)
            ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
            ->count();
            // dd($notValidated);

            $validated = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id')
                    ->Where('groups.user_id', '=', auth()->user()->id );
            })
            ->where('verification', '!=', null)
            ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
            ->count();
            // dd($validated);
    
            $content = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id')
                    ->Where('groups.user_id', '=', auth()->user()->id );
            })
            ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
            ->orderBy('contents.created_at')
            ->groupBy(DB::raw("MONTH(contents.created_at)"))
            ->get()->all();

        }else {
            $late = Content::whereColumn('verification', '>', 'deadline')
                ->where('user_id', '=', auth()->user()->id)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($late);
    
            $notValidated = Content::where('verification', null)
                ->where('user_id', '=', auth()->user()->id)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($notValidated);

            $validated = Content::where('verification', '!=', null)
                ->where('user_id', '=', auth()->user()->id)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($validated);
    
            $content = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(created_at) as month"))
            ->where('user_id', '=', auth()->user()->id)
            ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
            ->orderBy('created_at')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->all();
        }

        $content = $this->toArray($content);
        
        return view('home', compact('year','late','notValidated','validated','content'));
    }

    protected function toArray($arr)
    {
        for ($i=1; $i <= 12 ; $i++) { 
            $arrays[$i] = ['count' => 0,'month' => 0];
        }

        foreach($arr as $object)
        {
            // $month = Carbon::parse(strtotime("10/. $object->month ./2003"))->format('M');
            $arrays[$object->month] =  (array) $object  ;
        }

        return $arrays;
    }
}
