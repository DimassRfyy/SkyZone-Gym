const mainThumbnail = document.querySelector('#main-thumbnail img');
const buttons = document.querySelectorAll('#gallery button');

buttons.forEach(button => {
    button.addEventListener('click', function() {
        // Update the main thumbnail image source
        mainThumbnail.src = this.querySelector('img').src;

        // Remove active state from all buttons
        buttons.forEach(btn => {
            btn.classList.remove('ring-[3px]', 'ring-[#835DFE]');
            btn.classList.add('opacity-50');
        });

        // Add active state to the clicked button
        this.classList.remove('opacity-50');
        this.classList.add('ring-[3px]', 'ring-[#835DFE]');
    });
});