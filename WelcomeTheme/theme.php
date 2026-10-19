<?php
use ThemeEngine\api\{ThemeDefinition,PageDefinition,RouteDefinition,SectionSource};
use ThemeEngine\api\contracts\ITheme;
use object\ObjectFactory;
return new class implements ITheme {
    public function getDefinition(): ThemeDefinition
    {
        return new ThemeDefinition(
            label: 'Welcome',
            pages: [
                'home'=>new PageDefinition('home','Home',['content'=>SectionSource::json('documents/home.json')]),
                'about'=>new PageDefinition('about','About',['content'=>SectionSource::json('documents/about.json')]),
                'contact'=>new PageDefinition('contact','Contact',['content'=>SectionSource::json('documents/contact.json')]),
            ],
            routes: [
                new RouteDefinition('/','home',(new ObjectFactory())->setClassName(\WelcomeTheme\pages\HomePage::class)),
                new RouteDefinition('/about','about',(new ObjectFactory())->setClassName(\WelcomeTheme\pages\AboutPage::class)),
                new RouteDefinition('/contact','contact',(new ObjectFactory())->setClassName(\WelcomeTheme\pages\ContactPage::class)),
            ],
            sections: [
                'header'=>SectionSource::json('sections/header.json'),
                'footer'=>SectionSource::json('sections/footer.json'),
                'side_l'=>SectionSource::json('sections/side_l.json'),
                'side_r'=>SectionSource::json('sections/side_r.json'),
            ],
            settings: [
                'site_title'=>['type'=>'text','label'=>'Site title','default'=>'Welcome','max_length'=>80,'required'=>true],
                'tagline'=>['type'=>'text','label'=>'Tagline','default'=>'A simple place to begin.','max_length'=>180],
                'contact_email'=>['type'=>'text','label'=>'Contact email','default'=>'hello@example.com','max_length'=>254,'description'=>'Replace the example address with your own.'],
                'contact_intro'=>['type'=>'textarea','label'=>'Contact introduction','default'=>'Have a question or an idea? We would love to hear from you.','max_length'=>1000],
                'footer_text'=>['type'=>'text','label'=>'Footer text','default'=>'Built with AWT and Theme Engine.','max_length'=>180],
                'accent'=>['type'=>'color','label'=>'Accent color','default'=>'#0071e3'],
            ],
            stylesheets: ['/welcome-theme/theme.css'],
        );
    }
};
