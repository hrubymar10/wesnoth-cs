<?php

$db = get_db_files("./", true);

if (!file_exists("get_cs_sk_out")){
    mkdir("get_cs_sk_out", 0777);
}

foreach ($db as $dir){
    if (!is_file($dir)){
        $lang = get_db_files($dir, false);
        if (in_array('cs.po', $lang)){
            if (!file_exists("get_cs_sk_out/cs")){
                mkdir("get_cs_sk_out/cs", 0777);
            }
            copy("$dir/cs.po", "get_cs_sk_out/cs/$dir.po");
        }
        if (in_array('sk.po', $lang)){
            if (!file_exists("get_cs_sk_out/sk")){
                mkdir("get_cs_sk_out/sk", 0777);
            }
            copy("$dir/sk.po", "get_cs_sk_out/sk/$dir.po");
        }
    }
}

function get_db_files ($db_path){
    $files = array();
    if ($handle = opendir($db_path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && $file != "get_cs_sk_out") {
                $files[] = $file;
            }
        }
        closedir($handle);
    }

    return $files;
}