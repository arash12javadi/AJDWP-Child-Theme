// media library access
jQuery(document).ready(function($){
    $('#open-media-library').on('click', function(e){
        e.preventDefault();

        var mediaFrame = wp.media({
            title: 'Select or Upload Media',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });

        mediaFrame.on('select', function(){
            var attachment = mediaFrame.state().get('selection').first().toJSON();
            var imageUrl = attachment.url;

            $('#selected-image').attr('src', imageUrl);
            $('#selected-image-url').val(imageUrl);
        });

        mediaFrame.open();
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById('toggle-social-links');
    const table = document.getElementById('social-links-table');

    toggleBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default button behavior

        if (table.style.display === "none") {
            table.style.display = "table";
            toggleBtn.textContent = "-";
        } else {
            table.style.display = "none";
            toggleBtn.textContent = "+";
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById('toggle-user-profile');
    const useDetailsDiv = document.getElementById('edit-user-details');

    toggleBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default button behavior

        if (useDetailsDiv.style.display === "none") {
            useDetailsDiv.style.display = "block";
            toggleBtn.textContent = "-";
        } else {
            useDetailsDiv.style.display = "none";
            toggleBtn.textContent = "+";
        }
    });
});