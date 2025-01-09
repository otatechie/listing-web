<template>
    <div>
        <Toast />
    </div>
</template>

<style>
.p-toast-message-text {
    position: relative !important;
    bottom: 3px !important;
}
</style>

<script>
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';

export default {
    components: {
        Toast,
    },
    setup() {
        const toast = useToast();
        return { toast };
    },
    watch: {
        '$page.props.flash': {
            handler(newVal) {
                // Custom message for two-factor-authentication-enabled
                if (newVal['two-factor-authentication-enabled']) {
                    this.toast.add({
                        severity: 'success',
                        summary: 'Two-Factor Authentication',
                        detail: 'Two-factor authentication has been enabled.',
                    });
                    return;
                }

                // Custom message for two-factor-authentication-disabled
                if (newVal['two-factor-authentication-disabled']) {
                    this.toast.add({
                        severity: 'info',
                        summary: 'Two-Factor Authentication',
                        detail: 'Two-factor authentication has been disabled.',
                    });
                    return;
                }

                // Custom message for recovery-codes-generated
                if (newVal['recovery-codes-generated']) {
                    this.toast.add({
                        severity: 'success',
                        summary: 'Recovery Codes',
                        detail: 'Recovery codes have been successfully generated.',
                    });
                    return;
                }

                  // Custom message for recovery-codes-generated
                  if (newVal['verification-link-sent']) {
                    this.toast.add({
                        severity: 'success',
                        summary: 'Verification Link',
                        detail: 'A new email verification link has been emailed to you!',
                    });
                    return;
                }

                // Handle combined success-related messages
                if (
                    newVal.success ||
                    newVal.message ||
                    newVal.status ||
                    newVal['profile-information-updated']
                ) {
                    this.toast.add({
                        severity: 'success',
                        summary: 'Success',
                        detail:
                            newVal.success ||
                            newVal.message ||
                            newVal.status ||
                            newVal['profile-information-updated'],
                    });
                }

                // Handle error notifications
                if (newVal.error) {
                    this.toast.add({
                        severity: 'error',
                        summary: 'Error',
                        detail: newVal.error,
                    });
                }

                // Handle form validation errors
                const errors = this.$page.props.errors || {};
                if (Object.keys(errors).length > 0) {
                    this.toast.add({
                        severity: 'error',
                        summary: 'Form Error',
                        detail: 'Please fix the errors in the form.',
                    });
                }
            },
            deep: true,
        },
    },

};
</script>
