import $ from 'jquery';

export default function addCopyCodeLabel() {
    if (navigator.clipboard) {
        let blocks = $("pre[class*=allow_copy]");
        blocks.each(function () {
            let block = $(this);
            let button = $('<button class="clipboard"></button>');
            button.click(copyCode);
            button.click(function (event) {
                $(event.target).addClass('animate');
            });
            button.on('animationend', function (event) {
                $(event.target).removeClass('animate');
            });
            block.append(button);
        });
    }

    async function copyCode(event) {
        const button = $(event.target);
        const pre = button.parent();
        let code = pre.find("code");
        let text = code.text();
        await navigator.clipboard.writeText(text);
    }
}
