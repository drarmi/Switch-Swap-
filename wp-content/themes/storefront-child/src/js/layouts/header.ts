/**
 * Represents the header functionality of the website.
 */
class Header {
    private static instance: Header;

    /**
     * Creates an instance of the Header class.
     */
    private constructor() {
        this.initHeaderFixed();
        this.initMobileMenu();
    }

    /**
     * Get a singleton instance of the Header class.
     *
     * @return {Header} The singleton instance of the Header class.
     */
    public static getInstance(): Header {
        if (!this.instance) {
            this.instance = new this();
        }
        return this.instance;
    }

    /**
     * Initializes the mobile menu toggle functionality.
     */
    private initMobileMenu(): void {
        const burgerElement = document.querySelector<HTMLElement>('.js-site-header .js-burger-mobile');
        const headerNav = document.querySelector<HTMLElement>('.js-header-nav');

        if (burgerElement && headerNav) {
            burgerElement.addEventListener('click', () => {
                burgerElement.classList.toggle('active');
                headerNav.classList.toggle('open');
            });
        }
    }

    /**
     * Initializes the fixed header style when scrolling down the page.
     */
    private initHeaderFixed(): void {
        const headerElement = document.querySelector<HTMLElement>('.js-site-header');

        if (!headerElement) return;

        // Cache selectors for different page templates to avoid repeated queries
        const homeHeader = document.querySelector<HTMLElement>('.home .js-site-header');
        const aboutHeader = document.querySelector<HTMLElement>('.page-template-about .js-site-header');

        const documentRef = headerElement?.ownerDocument || document;
        const windowRef = documentRef.defaultView || window;

        windowRef.addEventListener('scroll', () => {
            const operationType = windowRef.scrollY > 50 ? 'add' : 'remove';

            headerElement.classList[operationType]('fixed');
            homeHeader?.classList[operationType]('dark');
            aboutHeader?.classList[operationType]('dark');
        });
    }
}

// Initialize the Header functionality
Header.getInstance();

export {};
