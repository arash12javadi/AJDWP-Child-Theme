<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//__________________________________________________________________________//
//			Theme Update From Github Repo
//__________________________________________________________________________//

// Automatic theme updates from the GitHub repository
add_filter('pre_set_site_transient_update_themes', 'automatic_GitHub_theme_updates', 100, 1);

function automatic_GitHub_theme_updates($data) {
    $theme   = get_stylesheet(); // Folder name of the current theme
    $current = wp_get_theme()->get('Version'); // Get the version of the current theme
    $user    = 'arash12javadi'; // GitHub username
    $repo    = 'Hello-Elementor-Child'; // Repository name

    // GitHub API URL
    $url = 'https://api.github.com/repos/' . $user . '/' . $repo . '/releases/latest';

    // Set up headers
    $context = stream_context_create([
        'http' => [
            'header' => "User-Agent: " . $user . "\r\n",
            'timeout' => 30,
        ],
    ]);

    // Fetch the API response
    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        error_log('GitHub API request failed for URL: ' . $url);
        return $data;
    }

    // Decode the JSON response
    $file = json_decode($response);

    // Ensure we have a valid response
    if (is_null($file)) {
        error_log('Invalid JSON response from GitHub API: ' . $response);
        return $data;
    }

    if (empty($file->tag_name)) {
        error_log('GitHub release data missing "tag_name" field: ' . $response);
        return $data;
    }

    // Extract the latest version
    $update = filter_var($file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Check if an update is needed
    if (version_compare($update, $current, '>')) {
        $data->response[$theme] = [
            'theme'       => $theme,
            'new_version' => $update,
            'url'         => 'https://github.com/' . $user . '/' . $repo,
            'package'     => 'https://codeload.github.com/' . $user . '/' . $repo . '/zip/refs/heads/main',
        ];
    }

    return $data;
}


?>
