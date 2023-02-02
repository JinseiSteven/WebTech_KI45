
window.addEventListener('load', function () {
    var root = document.querySelector(':root');
    var colorcheckbox = document.getElementById('color-checkbox');

    

    const themeSwitcher = (slider) =>  {
        if (slider.target.checked) {
            setCookie('theme', 'dark')
            Nosifier.warning('Watchout, dark mode is coming!')
            switchTheme('dark')
        }
        else {
            setCookie('theme', 'light') 
            Nosifier.info('Time for some light!')
            switchTheme('light')
        }
    }   
   


    const switchTheme = (type) => {
        if (type == 'dark') {
            root.style.setProperty('--main-bg-color', '#1e1e1e');
            root.style.setProperty('--main-component-color', '#292929');
            root.style.setProperty('--main-accent-color', '#14ba96');
            root.style.setProperty('--main-sub-color', '#64d195');
            root.style.setProperty('--main-glow-color', '#84fdbb');
            root.style.setProperty('--selected-text-color', '#ede7e7');
            root.style.setProperty('--divider-bar-color', '#363636');
            root.style.setProperty('--sub-text-color', '#55aa88');
            root.style.setProperty('--text-color-plain', '#c8c8c8');
    
        }else {
            root.style.setProperty('--main-bg-color', '#F5F6FA');
            root.style.setProperty('--main-component-color', '#FFFFFF');
            root.style.setProperty('--main-accent-color', '#116666');
            root.style.setProperty('--main-sub-color', '#338877');
            root.style.setProperty('--main-glow-color', '#55AA88');
            root.style.setProperty('--selected-text-color', '#FFFFFF');
            root.style.setProperty('--divider-bar-color', '#A8ABC4');
            root.style.setProperty('--sub-text-color', '#114455');
            root.style.setProperty('--text-color-plain', '#000000');
        }
    
    }

   
    if(getCookieValue('theme') == 'dark'){
        switchTheme('dark');
        colorcheckbox.checked = true;
    }  else switchTheme('light');
    
    colorcheckbox.addEventListener('change', themeSwitcher, false);
    
});


