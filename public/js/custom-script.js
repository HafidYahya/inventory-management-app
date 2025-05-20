console.log('hello')
document.addEventListener('rfid-update', (event) => {
                    // Update form fields
                    console.log('hell')
                    document.querySelector('input[id="data.epc"]').value = event.detail || '';
                    
                });