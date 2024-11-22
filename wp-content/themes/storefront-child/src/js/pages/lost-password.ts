import axios from 'axios';
import $ from '../../../node_modules/jquery';

interface AjaxObject {
    ajaxUrl: string;
}

declare const ajaxObject: AjaxObject | undefined;

class LostPassword {
    private static instance: LostPassword;

    private pageLostPass: HTMLElement | null;
    private pageRestorePass: HTMLElement | null;
    private submitBTNlost: HTMLElement | null;
    private showPassBTN: NodeListOf<SVGSVGElement> | null;
    private inputRestorePass: NodeListOf<HTMLInputElement> | null;

    private constructor() {
        this.pageLostPass = document.querySelector('.page-template-lost-password');
        this.pageRestorePass = document.querySelector('.page-template-restore-password');

        this.submitBTNlost = this.pageLostPass
            ? this.pageLostPass.querySelector("button[type='submit'][name='lost-password']")
            : null;
        this.inputRestorePass = this.pageRestorePass
            ? this.pageRestorePass.querySelectorAll("input[type='password'][name='pwd']")
            : null;
        this.showPassBTN = this.pageRestorePass ? this.pageRestorePass.querySelectorAll('svg.hide') : null;

        if (this.submitBTNlost) {
            this.submitBTNlost.addEventListener('click', this.handleSubmit.bind(this));
        }

        if (this.inputRestorePass) {
            this.inputRestorePass.forEach((input) => {
                input.addEventListener('keyup', this.controlInput);
            });
        }

        if (this.showPassBTN) {
            this.showPassBTN.forEach((btn) => {
                btn.addEventListener('click', this.controlShowPassBTN);
            });
        }
    }

    public static getInstance(): LostPassword {
        if (!this.instance) {
            this.instance = new this();
        }
        return this.instance;
    }

    private handleSubmit(event: Event): void {
        event.preventDefault();

        const form = (event.target as HTMLElement).closest('form') as HTMLFormElement;
        if (!form) return;

        const formData = new FormData(form);
        formData.append('action', 'reset_password');

        const lostPasswordForm = document.querySelector('.lost-pasword-form') as HTMLElement | null;
        const lostPasswordSend = document.querySelector('.lost-pasword-send') as HTMLElement | null;
        const submitBTN = form.querySelector("button[type='submit']") as HTMLButtonElement;

        // Disable the submit button to prevent multiple submissions
        if (submitBTN) submitBTN.disabled = true;

        if (ajaxObject?.ajaxUrl) {
            axios
                .post(ajaxObject.ajaxUrl, formData)
                .then((response) => {
                    if (response.data.success) {
                        // Ensure elements exist before trying to modify their display
                        if (lostPasswordForm && lostPasswordSend) {
                            lostPasswordForm.style.display = 'none';
                            lostPasswordSend.style.display = 'block';
                        }
                    } else {
                        alert(response.data.message || 'An error occurred.');
                    }
                })
                .catch((error) => {
                    console.error('Error resetting password:', error);
                    alert('An error occurred while processing your request.');
                })
                .finally(() => {
                    if (submitBTN) submitBTN.disabled = false;
                });
        } else {
            console.error('ajaxUrl is undefined or invalid.');
            alert('An error occurred: Unable to send the request.');
        }
    }

    private controlShowPassBTN(event: Event): void {
        const target = event.target as SVGSVGElement;
        const parent = target.closest('.auth-field');

        if (parent) {
            const input = parent.querySelector('input[type="password"], input[type="text"]') as HTMLInputElement | null;

            if (input) {
                const isActive = target.getAttribute('data-active') === 'true';

                if (isActive) {
                    target.setAttribute('data-active', 'false');
                    input.type = 'password';
                } else {
                    target.setAttribute('data-active', 'true');
                    input.type = 'text';
                }
            }
        }
    }

    private controlInput(event: Event): void {
        const target = event.target as HTMLInputElement;
        const parent = target.closest('.auth-field');

        if (parent) {
            const inputInfo = parent.querySelector('.input-info');
            if (inputInfo) {
                const span = inputInfo.querySelector('span') as HTMLElement | null;
                const svgs = inputInfo.querySelectorAll('svg') as NodeListOf<SVGSVGElement>;

                if (target.value) {
                    if (span) span.style.display = 'none';

                    svgs.forEach((svg) => {
                        svg.style.display = 'inline';
                    });
                } else {
                    if (span) span.style.display = 'inline';

                    svgs.forEach((svg) => {
                        svg.style.display = 'none';
                    });
                }
            }
        }
    }
}


document.addEventListener('DOMContentLoaded', () => {
    LostPassword.getInstance();
});

export {};
