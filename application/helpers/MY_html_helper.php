<?php

function stylesheet($src,$absolute=false) {
  if ($absolute) {
    echo link_tag($src);
  } else {
    echo link_tag("stylesheets/$src.css");
  }
}
function less($src,$absolute=false) {
  if ($absolute) {
    echo link_tag(array('href'=>$src,'rel'=>'stylesheet/less','type'=>'text/css'));
  } else {
    echo link_tag(array('href'=>"stylesheets/less/$src.less",'rel'=>'stylesheet/less','type'=>'text/css'));
  }
}


function javascript($src,$absolute=false) {
  if ($absolute) {
    echo "<script type=\"text/javascript\" src=\"$src\"></script>\n";
  } else {
    echo "<script type=\"text/javascript\" src=\"/js/$src.js\"></script>\n";
  }
}
function load_js($lib) {
  switch($lib) {
    case 'jquery':
      javascript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',true);
      break;
    case 'google_maps':
      javascript('http://maps.googleapis.com/maps/api/js?key=AIzaSyDWtEby8hirZg1MO1Rne1C_j8Ut3kxbrLs&sensor=true',true);
      break;
    case 'google_javascript_api':
      javascript('https://www.google.com/jsapi',true);
    case 'less':
      javascript('less-1.3.0.min');
      break;
    case 'bootstrap':
      $libs = array('alert','button','carousel','collapse','dropdown','modal','scrollspy','tab','tooltip','transition','typeahead');
      foreach ($libs as $lib) {
        javascript("bootstrap/bootstrap-$lib");
      }
      break;
    case 'typekit':
      echo '<script type="text/javascript" src="http://use.typekit.com/ddl3lbl.js"></script><script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
      break;
  }
}

