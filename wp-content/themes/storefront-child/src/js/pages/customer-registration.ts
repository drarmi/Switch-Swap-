class CustomerRegistration {
    private static instance: CustomerRegistration;
    private currentStep: number = 0;

    // Elements used in the registration process
    private steps: NodeListOf<HTMLElement>;
    private progressItems: NodeListOf<HTMLElement>;
    private btnNext: NodeListOf<HTMLElement>;
    private btnSkip: NodeListOf<HTMLElement>;
    private btnBack: HTMLElement;
    private usernameInput: HTMLInputElement;
    private emailInput: HTMLInputElement;
    private agreeCheckbox: HTMLInputElement;
    private firstNextButton: HTMLButtonElement;

    // Elements for file input and image preview
    private fileInput: HTMLInputElement;
    private previewImage: HTMLImageElement;

    private constructor() {
        this.steps = document.querySelectorAll(".registration-step");
        this.progressItems = document.querySelectorAll(".registration-progress-bar__step");
        this.btnNext = document.querySelectorAll(".registration-btn-dark--next");
        this.btnSkip = document.querySelectorAll(".auth-btn-skip");
        this.btnBack = document.querySelector(".registration-progress-bar__back")!;
        this.usernameInput = document.getElementById("reg_username") as HTMLInputElement;
        this.emailInput = document.getElementById("email") as HTMLInputElement;
        this.agreeCheckbox = document.getElementById("agree") as HTMLInputElement;
        this.firstNextButton = this.steps[0].querySelector(".registration-btn-dark--next") as HTMLButtonElement;
        this.fileInput = document.getElementById("profile_photo") as HTMLInputElement;
        this.previewImage = document.getElementById("previewImage") as HTMLImageElement;

        this.initRegistrationSteps();
        this.initFileInputHandler();
    }

    public static getInstance(): CustomerRegistration {
        if (!this.instance) {
            this.instance = new this();
        }
        return this.instance;
    }

    private initRegistrationSteps(): void {
        this.updateStep();
        this.toggleFirstNextButton();
        this.addEventListeners();
    }

    private updateStep(): void {
        // Hide all steps
        this.steps.forEach((step) => (step.style.display = "none"));
        // Show the current step
        this.steps[this.currentStep].style.display = "flex";

        // Update progress bar
        this.progressItems.forEach((item, index) => {
            if (index <= this.currentStep) {
                item.classList.add("registration-progress-bar__step--active");
            } else {
                item.classList.remove("registration-progress-bar__step--active");
            }
        });
    }

    private toggleFirstNextButton(): void {
        if (
            this.usernameInput.value.trim() &&
            this.emailInput.value.trim() &&
            this.agreeCheckbox.checked
        ) {
            this.firstNextButton.disabled = false;
        } else {
            this.firstNextButton.disabled = true;
        }
    }

    private addEventListeners(): void {
        // Listen to input events on username and email fields
        this.usernameInput.addEventListener("input", () => this.toggleFirstNextButton());
        this.emailInput.addEventListener("input", () => this.toggleFirstNextButton());
        this.agreeCheckbox.addEventListener("change", () => this.toggleFirstNextButton());

        // Handle the "Next" button click
        this.btnNext.forEach((button) => {
            button.addEventListener("click", () => {
                if (this.currentStep < this.steps.length - 1) {
                    this.currentStep++;
                    this.updateStep();
                }
            });
        });

        // Handle the "Skip" button click
        this.btnSkip.forEach((button) => {
            button.addEventListener("click", () => {
                if (this.currentStep < this.steps.length - 1) {
                    this.currentStep++;
                    this.updateStep();
                }
            });
        });

        // Handle the "Back" button click
        this.btnBack.addEventListener("click", () => {
            if (this.currentStep > 0) {
                this.currentStep--;
                this.updateStep();
            }
        });
    }

    private initFileInputHandler(): void {
        this.fileInput.addEventListener("change", () => {
            const file = this.fileInput.files?.[0]; // Get the selected file
            if (file) {
                const reader = new FileReader(); // Create a FileReader
                reader.onload = (e) => {
                    this.previewImage.src = e.target?.result as string; // Set the img src to the file's data URL
                    this.previewImage.style.display = "block"; // Make the image visible
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                this.previewImage.src = "";
                this.previewImage.style.display = "none";
            }
        });
    }
}

// Initialize the CustomerRegistration functionality
document.addEventListener("DOMContentLoaded", () => {
    CustomerRegistration.getInstance();
});

export {};