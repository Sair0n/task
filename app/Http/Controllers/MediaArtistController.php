<?php

namespace App\Http\Controllers;

use App\Models\Media_artist;
use App\Models\Media_track;
use Illuminate\Http\Request;
use QL\QueryList;
use Storage;
use GuzzleHttp\Exception\ClientException;

class MediaArtistController extends Controller
{
    public function show($slug){
        $artist = Media_artist::where('slug', $slug)->first();

        if (! $artist){
            $data = $this->parser($slug);
            if (! $data){
                return redirect()->route('welcome')->withErrors(['notfound' => 'Указанный адрес soundcloud.com/' . $slug . ' не найден']);
            }

            return view('main')->with('artist', $data)
                                    ->with('tracks', $data['tracks']);
        }

        return view('main')->with('artist', $artist)
                                ->with('tracks', $artist->media_tracks);
    }


    public function parser($slug){
        $ql = QueryList::getInstance();
        try {
            $ql->get('https://soundcloud.com/'. $slug .'/tracks');
        }catch (ClientException $e){
            return false;
        }
        $data['slug'] = $slug;
        $data['name'] = $ql->find('h1')->text();

        $img = $ql->find('img')->attr('src');
        if ($img){
            $file = file_get_contents($img);
            $filename = $slug . '.jpg';
            Storage::put('public/avatars/'.$filename, $file);
            $data['userpic'] = $filename;
        }
        $artist = Media_artist::create($data);

        $tracks['tracks'] = $ql->find('h2>a[itemprop]')->texts();
        foreach ($tracks['tracks'] as $track) {
            Media_track::create([
                'name' => $track,
                'media_artist_id' => $artist->id,
            ]);
            $data['tracks'][]['name'] = $track;
        }
        if ( empty($data['tracks'])){$data['tracks'] = '';}

        return $data;
    }

}
