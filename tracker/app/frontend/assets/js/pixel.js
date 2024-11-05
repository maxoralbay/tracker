(function () {
    // This function initializes and injects the dynamic form
    function initEmbedForm() {
        const url = window.location.href;
        const domain = window.location.hostname;
        const title = document.title;
        const description = document.querySelector('meta[name="description"]')?.content || '';

        // Form creation
        const form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', '#');

        // Dynamic fields
        const fields = [
            {label: 'URL', value: url},
            {label: 'Domain', value: domain},
            {label: 'Title', value: title},
            {label: 'Description', value: description}
        ];

        fields.forEach(({label, value}) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'input-wrapper';

            const labelElem = document.createElement('label');
            labelElem.textContent = label;
            wrapper.appendChild(labelElem);

            const input = document.createElement('input');
            input.type = 'text';
            input.value = value;
            wrapper.appendChild(input);

            form.appendChild(wrapper);
        });

        // Submit button
        const submit = document.createElement('button');
        submit.type = 'submit';
        submit.textContent = 'Submit';
        form.appendChild(submit);

        // Inject the form into the body
        document.body.appendChild(form);

        // Optional: Style isolation
        const style = document.createElement('style');
        style.textContent = `
      .input-wrapper { margin-bottom: 10px; }
      label { display: block; font-weight: bold; }
      input { width: 100%; padding: 8px; margin-top: 5px; }
      button { padding: 10px 20px; background: blue; color: white; border: none; cursor: pointer; }
    `;
        document.head.appendChild(style);
    }

    // Expose initEmbedForm globally so it can be called by the loader if needed
    window.initEmbedForm = initEmbedForm;

    // Optionally auto-init the form upon script load
    initEmbedForm();
})();