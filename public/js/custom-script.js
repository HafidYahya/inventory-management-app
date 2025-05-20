console.log('hello')
document.addEventListener('rfid-update', (event) => {
                    // Update form fields
                    console.log('hell')
                    const input = document.querySelector('input[id="data.epc"]')

                    input.value = event.detail || '';
                    input.dispatchEvent(new Event('input', { bubbles: true }));

                });