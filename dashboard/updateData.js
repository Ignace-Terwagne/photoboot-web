$(document).ready(function () {
    const progressbars = [
        document.getElementById('progressActiveTokens'),
        document.getElementById('progressTotalTokens'),
        document.getElementById('progressImage')
    ];
    function getData() {
        $.ajax({
            url: 'getData.php',
            success: function (data) {
                data = JSON.parse(data);
                const progressbarsData = [
                    (data['active tokens'] / data['total tokens']) * 100,
                    (data['total tokens'] / 100) * 100,
                    Math.round((data['image storage'][1] / 524288000) * 100),
                ];
                if (data['total tokens'] == 0) {
                    progressbarsData[0] = 0
                }
                for (const [index, bar] of progressbars.entries()) {
                    const innerDiv = bar.querySelector('.progress-bar');
                    const bar_value = progressbarsData[index];
                    innerDiv.classList.remove('progress-bar-animated');
                    innerDiv.classList.remove('progress-bar-striped');
                    bar.setAttribute('aria-value', bar_value);
                    innerDiv.style.width = bar_value + '%';
                    if (bar_value < 75) {
                        innerDiv.classList.add('bg-success');

                    } else if (bar_value > 75 && bar_value < 100) {
                        innerDiv.classList.add('bg-warning');
                    } else {
                        innerDiv.classList.add('bg-danger');
                    }

                    $('#ActiveTokenCount').text(data['active tokens']);
                    $('#TotalTokenCount').text(data['total tokens']);
                    $('#ImageStorageCount').text(data['image storage'][0]);
                }
            }
        });
    }
    setInterval(getData, 5000);
});