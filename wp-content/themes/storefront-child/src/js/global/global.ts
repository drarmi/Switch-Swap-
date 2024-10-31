// import 'chosen-js'; // https://harvesthq.github.io/chosen/
import AOS from 'aos'; // https://michalsnik.github.io/aos/
import '@fancyapps/fancybox'; // https://obu.edu/_resources/ldp/galleries/fancybox/

interface FancyboxOptions {
    // add here Fancybox properties
    toolbar?: boolean;
    smallBtn?: boolean;
}

class Global {
    private static instance: Global;

    private constructor() {
        this.initAnimations(); 
        this.extractSvg();
        this.initSmoothScroll();
        this.redirectWpcf7MailSent(); 
    }

    /**
     * Get a singleton instance of the Global class
     */
    public static getInstance(): Global {
        if (!this.instance) {
            this.instance = new this();
        }
        return this.instance;
    } 

    /**
     * Replace image elements with SVG content
     */
    private extractSvg(): void {
        const svgElements = document.querySelectorAll<HTMLImageElement>('.extract-svg');

        if (!svgElements) return;

        svgElements.forEach((img) => {
            const imgURL = img.getAttribute('src');

            if (!imgURL) return;

            fetch(imgURL)
                .then((response) => response.text())
                .then((data) => {
                    const parser = new DOMParser();
                    const svgDocument = parser.parseFromString(data, 'image/svg+xml');
                    const svg = svgDocument.querySelector('svg');

                    if (!svg) return;

                    svg.removeAttribute('xmlns:a');

                    if (!svg.getAttribute('viewBox') && svg.getAttribute('height') && svg.getAttribute('width')) {
                        svg.setAttribute('viewBox', `0 0 ${svg.getAttribute('height')} ${svg.getAttribute('width')}`);
                    }

                    img.replaceWith(svg);
                })
                .catch((error) => console.error('Error fetching SVG:', error));
        });
    }

     

    /**
     * Redirect on Contact Form 7 mail sent
     */
    private redirectWpcf7MailSent(): void {
        /* document.addEventListener("wpcf7mailsent", function () {
            document.location.href = "/thank/";
        }); */
    }

    /**
     * Initialize AOS (Animate On Scroll) plugin
     */
    private initAnimations(): void {
        window.document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 500,
                disable: 'mobile',
            });
        });
    }

    /**
     * Smooth scroll to anchor links
     */
    private initSmoothScroll(): void {
        const anchorLinks = document.querySelectorAll<HTMLAnchorElement>('a[href^="#"]');

        anchorLinks &&
            anchorLinks.forEach((link) => {
                link.addEventListener('click', (event) => {
                    const targetId = link.getAttribute('href');
                    if (targetId && targetId.length > 1) {
                        const targetElement = document.querySelector(targetId);

                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.getBoundingClientRect().top + window.scrollY,
                                behavior: 'smooth',
                            });
                            event.preventDefault();
                        }
                    }
                });
            });
    }
}

// Initialize the Global instance
Global.getInstance();
