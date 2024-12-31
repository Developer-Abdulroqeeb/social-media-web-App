const videoInput = document.getElementById('videoInput');
const videoPreview = document.getElementById('videoPreview');
const videoSource = document.getElementById('videoSource');
const videoThumbnail = document.getElementById('videoThumbnail');
const meta = document.getElementById('meta');
// Video preview and duration extraction
const form =  document.getElementById('form');
const vid_duration = document.getElementById('vid_duration');


videoInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith('video/')) {
        const videoURL = URL.createObjectURL(file);

        // Set video source and load video
        videoSource.src = videoURL;
        videoPreview.load();
        videoPreview.style.display = 'block'; // Show the video preview
        videoThumbnail.style.display = 'none'; // Hide the thumbnail or placeholder

        // Create a video element to get the duration
        const videoElement = document.createElement('video');
        
      
        videoElement.addEventListener('loadedmetadata', function() {
            const duration = videoElement.duration;  // Duration in seconds
            const size = file.size;
            vid_duration.innerHTML = size;
            console.log('Video duration:', duration, 'seconds');
            // vid_duration.textContent = duration;
            form.addEventListener('submit',function(e){
                if(duration > 600){
                    e.preventDefault();
                    meta.innerHTML = "video duration exceeds 2min";
                    alert("video duration exceedds 2min");
                }
                 if (size> (40*1024*1024)){
                    e.preventDefault();
                    meta.innerHTML = "video size exceeds 20mb";
                    alert("video size exceeds 40mb");
                 }
            });
        });
        videoElement.src = videoURL;
        videoElement.addEventListener('ended', function() {
            URL.revokeObjectURL(videoURL);
        });
    } else {
        console.log('Please select a valid video file.');
    }
});
