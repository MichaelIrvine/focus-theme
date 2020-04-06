const images = document.querySelectorAll('.gallery-item--image');
const closeButtons = document.querySelectorAll('.close-lightbox');
const captions = document.querySelectorAll('.gallery-item--caption');
let imgPos, windowHalf;

function openLightBox() {
  images.forEach((image) => {
    image.classList.add('faded');
  });

  imgPos = this.getBoundingClientRect().left;
  windowHalf = window.innerWidth / 2;
  console.log(imgPos);

  if (!this.classList.contains('faded')) {
    this.classList.add('faded');
    if (!this.nextElementSibling.classList.contains('hidden')) {
      this.nextElementSibling.classList.add('hidden');
    }
  } else {
    this.classList.remove('faded');
    if (this.nextElementSibling.classList.contains('hidden')) {
      this.nextElementSibling.classList.remove('hidden');
    }
  }

  if (windowHalf > imgPos) {
    this.nextElementSibling.classList.add('pos-right');
  }

  if (windowHalf < imgPos) {
    this.nextElementSibling.classList.add('pos-left');
  }
}

function closeLightbox() {
  captions.forEach((caption) => {
    caption.classList.add('hidden');
    setTimeout(() => {
      caption.classList.remove('pos-right');
      caption.classList.remove('pos-left');
    }, 500);
  });

  images.forEach((image) => {
    image.classList.remove('faded');
  });
}

// Open lightbox
images.forEach((image) => image.addEventListener('click', openLightBox));
// Close lightbox
closeButtons.forEach((button) =>
  button.addEventListener('click', closeLightbox)
);
// Close light box if it is open and someone is scrolling
// window.addEventListener('scroll', closeLightbox);
