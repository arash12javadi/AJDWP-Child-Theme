<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//__________________________________________________________________________//
//			Theme Update From Github Repo
//__________________________________________________________________________//

// Automatic theme updates from the GitHub repository
add_filter('pre_set_site_transient_update_themes', 'automatic_GitHub_updates', 100, 1);
function automatic_GitHub_updates($data) {
    $theme      = get_stylesheet(); // Folder name of the current theme
    $current    = wp_get_theme()->get('Version'); // Get the version of the current theme
    $user       = 'arash12javadi'; // The GitHub username hosting the repository
    $repo       = 'Hello-Elementor-Child'; // Repository name as it appears in the URL
    $file       = @json_decode(@file_get_contents('https://api.github.com/repos/'.$user.'/'.$repo.'/releases/latest', false, stream_context_create(['http' => ['header' => "User-Agent: ".$user."\r\n"]])));
    $update     = filter_var($file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Only return a response if the new version number is higher than the current version
    if (version_compare($update, $current, '>')){
        $data->response[$theme] = array(
	'theme'       => $theme,
	'new_version' => $update,
	'url'         => 'https://github.com/'.$user.'/'.$repo,
	// 'package'     => $file->assets[0]->browser_download_url,
	// 'package'     => $file->zipball_url,
	'package'     => 'https://codeload.github.com/arash12javadi/Hello-Elementor-Child-Theme/zip/refs/heads/Theme',
        );
    }
    return $data;
}

?>