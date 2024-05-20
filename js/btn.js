// confirmation.js
document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.btn.danger');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const url = button.getAttribute('href');

            // Create the confirmation modal
            const modal = document.createElement('div');
            modal.className = 'confirmation-modal';
            modal.innerHTML = `
                <div class="modal-content">
                    <h2>Confirmar Eliminación</h2>
                    <p>¿Estás seguro de que deseas eliminarlo?</p>
                    <button class="confirm-btn">Aceptar</button>
                    <button class="cancel-btn">Cancelar</button>
                </div>
            `;
            document.body.appendChild(modal);

            // Add event listeners to modal buttons
            modal.querySelector('.confirm-btn').addEventListener('click', () => {
                // Create the completion message
                modal.querySelector('.modal-content').innerHTML = `
                    <div class="completion-container">
                        <div class="checkmark-container">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16"/>
                            </svg>
                        </div>
                        <p class="completion-message">Eliminado exitosamente</p>
                    </div>
                `;

                // Add CSS for completion message animation
                const style = document.createElement('style');
                style.innerHTML = `
                    .completion-container {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        height: 100px;
                    }
                    .checkmark-container {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                    .checkmark {
                        width: 56px;
                        height: 56px;
                        stroke-width: 2;
                        stroke: #4caf50;
                        stroke-miterlimit: 10;
                        fill: none;
                        animation: scale .3s ease-in-out .9s both;
                    }
                    .checkmark__circle {
                        stroke-dasharray: 166;
                        stroke-dashoffset: 166;
                        stroke-width: 2;
                        stroke-miterlimit: 10;
                        stroke: #4caf50;
                        fill: none;
                        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
                    }
                    .checkmark__check {
                        transform-origin: 50% 50%;
                        stroke-dasharray: 48;
                        stroke-dashoffset: 48;
                        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.6s forwards;
                    }
                    @keyframes stroke {
                        100% {
                            stroke-dashoffset: 0;
                        }
                    }
                    @keyframes scale {
                        0%, 100% {
                            transform: none;
                        }
                        50% {
                            transform: scale3d(1.1, 1.1, 1);
                        }
                    }
                    .completion-message {
                        font-size: 18px;
                        color: #4caf50;
                        opacity: 0;
                        animation: fadeIn 1.5s ease-in-out forwards;
                    }
                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                        }
                        100% {
                            opacity: 1;
                        }
                    }
                `;
                document.head.appendChild(style);

                setTimeout(() => {
                    document.body.removeChild(modal);
                    window.location.href = url;
                }, 2000);
            });

            modal.querySelector('.cancel-btn').addEventListener('click', () => {
                document.body.removeChild(modal);
            });
        });
    });
});
