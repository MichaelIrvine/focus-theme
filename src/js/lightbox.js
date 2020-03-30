const images = document.querySelectorAll('.gallery-item--image');
const closeButtons = document.querySelectorAll('.close-lightbox');
const captions = document.querySelectorAll('.gallery-item--caption');

function openLightBox() {

  images.forEach( image => {
    image.classList.add("faded");
  });
  
  if (!this.classList.contains("faded")) {
    this.classList.add("faded");
    if(!this.nextElementSibling.classList.contains("hidden")){
      this.nextElementSibling.classList.add("hidden");
    }
  } else {
    this.classList.remove("faded");
    if(this.nextElementSibling.classList.contains("hidden")){
      this.nextElementSibling.classList.remove("hidden");
    }
  };

  // Remove figcaption
  // Figure out position of image and put figcaption on left or right side
  // Close modal -- reset to normal
}

function closeLightbox(){
  images.forEach( image => {
    image.classList.remove('faded');
  });

  captions.forEach( caption => {
    caption.classList.add("hidden");
  });
};

images.forEach( image => image.addEventListener('click', openLightBox));
closeButtons.forEach( button => button.addEventListener('click', closeLightbox));