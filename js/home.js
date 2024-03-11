(function () {


    if (!isTouch()) {
        gsap.registerPlugin(ScrollTrigger);

        window.addEventListener('resize', ev => {
            ScrollTrigger.refresh();
        })

        // const header = document.querySelector('.header');
        // const clip = document.querySelector('.clipping-svg path');
        const clipPath = document.querySelector('.clipping-svg clipPath');
        const blured = document.querySelector('.clipping-svg feGaussianBlur');
        const videoWrap = document.querySelector('.firstSection__video');
        const video = document.querySelector('.firstSection__video video');
        // const perksSect = document.querySelector('#perks');

        video.play().then(() => {
            videoWrap.style.backgroundColor = '#000';
        });


        gsap.to(clipPath, {
            // transform: 'scale(8.8) translate(-9000,-36em)',
            // transform: 'scale(8.8) translate(-71.5em,-36em)',
            scale: 8.8,
            xPercent: -540,
            yPercent: -530,
            scrollTrigger: {
                trigger: '.header',
                endTrigger: '.productsSection',
                start: 'top top',
                end: 'top bottom',
                scrub: true,
                onUpdate: (self) => {
                    const {progress} = self;
                    if (progress > 0.5) {
                        let blur = (progress-0.5)*15;
                        blured.setAttribute('stdDeviation', blur);
                        video.style.filter = 'url("#blur")';
                        video.style.webkitFilter = 'url("#blur")';
                        video.style.opacity = 1.6-progress;
                    } else {
                        video.style.filter = '';
                        video.style.webkitFilter = '';
                        video.style.opacity = '';
                    }
                },
            }
        });

        gsap.to(videoWrap, {
            scrollTrigger: {
                trigger: '.header',
                endTrigger: '.productsSection',
                start: 'top top',
                end: 'top bottom',
                scrub: true,
                onEnterBack: () => {
                    videoWrap.style.position = '';
                    videoWrap.style.top = '';
                },
                onLeave: () => {
                    videoWrap.style.position = 'absolute';
                    videoWrap.style.top = '100%';
                }
            }
        });


        const perks = {
            trigger: '.perks',
            toggleActions: "play none none reverse",
            start: 'top 70%',
        }

        gsap.from('.perks .section__title', {
            y: 70,
            opacity: 0,
            delay: 0.3,
            scrollTrigger: perks
        });

        gsap.from('.perks .section__sub', {
            y: 50,
            opacity: 0,
            delay: 0.6,
            scrollTrigger: perks
        });

        gsap.from('.perks__item', {
            y: 50,
            opacity: 0,
            delay: 1,
            stagger: 0.3,
            scrollTrigger: perks
        });

    };

    document.querySelectorAll('.lotti').forEach((el, i) => {
        lottie.loadAnimation({
            container: el, // the dom element that will contain the animation
            renderer: 'svg',
            autoplay: true,
            loop: true,
            path: el.dataset.path,
            name: el.dataset.name,
            rendererSettings: {
                progressiveLoad: false,
            }
        });
    });

})();
