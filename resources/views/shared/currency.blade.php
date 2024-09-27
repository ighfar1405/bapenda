<script src="{{ asset('js/simple-mask-money.js') }}"></script> 
<script>
    function formatCurrency(element){
            const args = {            
                allowNegative: false,
                negativeSignAfter: false,
                prefix: '',
                suffix: '',
                fixed: true,
                fractionDigits: 2,
                thousandsSeparator: '.'            
            };
    
            // select the element
            const input = SimpleMaskMoney.setMask('#'+element, args);
        
            // This method return value of your input in format number to save in your database
            input.formatToNumber();
        }
</script>