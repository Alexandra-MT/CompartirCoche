//Custom element
class SelectMultiple extends HTMLElement{
    static formAssociated = true;
    options = [];
    checkbox = [];

    constructor(){
        super();
        this.attachShadow({mode:"open"});
        this.internals = this.attachInternals()
    }

    connectedCallback(){
        this.getAttributes();
        this.getOptions();
        this.render();
    }

    getOptions(){
        const parser = new DOMParser();
        const htmlFragment = parser.parseFromString(this.innerHTML, 'text/html');
        this.options = htmlFragment.querySelectorAll('option');
    }

    getStyles(){
        return `
        :host{
        display: inline-block;
        position: relative;
        user-select: none;
         }
        .header{
        color: rgb(3, 37, 43);
        border: .1rem solid #767676;
        padding: .4rem;
        border-radius: .2rem;
        padding-right: 2rem;
        background: white url('build/img/perfil/desplegar_menu.svg') right .5rem center/.5lh no-repeat;
        }
        .body{
        display:none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        border: .1rem solid #767676;
        background: white;
        box-shadow: 0 0 .5rem rgba(176,176,176,.7);
        max-height: 11vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #767676 white;
        }
        :host(.visible) .body{
        display: block;
        }
        .body label{
        padding: .4rem .7rem .3rem 2rem;
        display:block;
        background: white none .5rem center/.5lh no-repeat;
        }
        .body input:checked + label{
        background-image: url('build/img/check-solid.svg');
        }
        .body label:hover{
        background-color: #209CEE;
        color:white;
        }
        .body input{
        display:none;
        }
        `;
    }

    setValues(){
        const FD = new FormData();
        this.checkbox.forEach( cb => {
            if( cb.checked ){
                FD.append( `${this.name}[]`, cb.value);
            }
        });
        this.internals.setFormValue(FD);
    }

    getAttributes(){
        this.name = this.attributes.name.value;
    }
    render(){
        const combo_header = document.createElement('div');
        combo_header.className = 'header';
        combo_header.innerHTML = 'Seleccione una o más opciones';
        combo_header.addEventListener('click', e => {
            const visible_prev = document.querySelector('select-multiple.visible');
            if(visible_prev && visible_prev != this){
                visible_prev.classList.remove('visible');
            }
            this.classList.toggle('visible'); 
            e.stopPropagation();    
        });

        window.addEventListener('click', e => {
            this.classList.remove('visible'); 
        })

        const combo_body = document.createElement('div');
        combo_body.className = 'body';
        combo_body.addEventListener('click', e =>{
            e.stopPropagation();
        })

        const style = document.createElement('style');
        style.innerHTML = this.getStyles();

        this.shadowRoot.appendChild( style);
        this.shadowRoot.appendChild( combo_header );
        this.shadowRoot.appendChild( combo_body);

        Array.from(this.options).forEach( o => {
            const id = 'id_' + Math.round( Math.random() * 999999) + 100000;
            const div = document.createElement('div');
            const input = document.createElement('input');
            const label = document.createElement('label');
            input.type = 'checkbox';
            input.value = o.value;
            input.id = id;
            input.addEventListener('click', e => { this.setValues();});
            this.checkbox.push(input);
            label.innerHTML = o.innerHTML;
            label.htmlFor = id;

            div.appendChild(input);
            div.appendChild(label);
            combo_body.appendChild(div);
        });
    }
}

customElements.define('select-multiple', SelectMultiple)