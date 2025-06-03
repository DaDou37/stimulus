import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['postalCode', 'city'];
    
    async updateCityList() {

        const postalCode = this.postalCodeTarget.value;

        if(!postalCode){
            this.cityTarget.innerHTML = '<OPTION VALUE="">Selectionner une ville</OPTION>';
            return; 
        }

        const response = await fetch(`/ajax/cities?postalCode=${postalCode}`);

        const cities = await response.json();

        this.cityTarget.innerHTML = '<OPTION VALUE="">Selectionner une ville</OPTION>';

        cities.forEach(city => {
            const option = document.createElement('option');

            option.value = city.id;

            option.textContent = city.name;

            this.cityTarget.appendChild(option)
        });
    }


}
