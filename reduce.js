import imagemin from 'imagemin';
import imageminJpegRecompress from 'imagemin-jpeg-recompress';
import path from 'path'; // Useful for handling file paths

(async () => {
    try {
        // Compress images from the 'images' folder and store them in 'build/images'
        const files = await imagemin(['images/*.{jpg,png}'], {
            destination: path.join('build', 'images'), // Ensuring the path is correctly handled
            plugins: [
                imageminJpegRecompress({
                    quality: 'medium', // Set compression quality (low, medium, high)
                    progressive: true
                })
            ]
        });

        console.log('Images optimized successfully:');
        console.log(files);
    } catch (error) {
        console.error('Error optimizing images:', error);
    }
})();
