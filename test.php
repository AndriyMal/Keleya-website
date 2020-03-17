<?php
function prep_path()
{
    $json = file_get_contents('data.json');
    $obj = json_decode($json);

    foreach ($obj as $d) :
        $d = parse_url($d);
        $items[] = $d['path'];
    endforeach;

    $fp = fopen('redirects.json', 'w');
    fwrite($fp, json_encode($items));
    fclose($fp);

}

function prep_link(){
    $json = file_get_contents('convertcsv.json');
    $obj = json_decode($json);

    foreach ($obj as $d) :

        $links[] = 'https://keleya.de/mag/' . $d->category . $d->path;


    endforeach;

    $fp = fopen('redirects.json', 'w');
    fwrite($fp, json_encode($links));
    fclose($fp);


}


prep_link();
