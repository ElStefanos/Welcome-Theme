<?php
namespace WelcomeTheme\pages;
use URPC\api\contracts\IURPCDocument;
use URPC\api\contracts\IURPCBlock;
abstract class WelcomePage extends \ThemeEngine\controllers\ThemePage
{
    protected function prepareDocument(IURPCDocument $document): IURPCDocument
    {
        $settings = $this->themeEngine->settings();
        $email = filter_var(trim($settings['contact_email']), FILTER_VALIDATE_EMAIL);
        foreach ($document->getSections() as $blocks) foreach ($blocks as $root) {
            $this->applyBindings($root, $settings, $email);
            foreach ($root->getBlockChildren() as $child) if ($child->getBlockDescriptor()->getBlockName() === 'body') {
                $attrs=$child->getBlockAttributes();
                $attrs['class']=($attrs['class']??'').' welcome-site';
                $attrs['style']='--welcome-accent:'.$settings['accent'].';';
                $child->setBlockAttributes($attrs);
            }
        }
        return $document;
    }

    /** JSON defines all blocks; PHP only binds runtime values before URPC escapes them. */
    private function applyBindings(IURPCBlock $block, array $settings, string|false $email): void
    {
        $props = $block->getBlockDescriptor()->getBlockProps();
        $attrs = $block->getBlockAttributes();
        if (isset($props['setting'])) {
            $block->setBlockContent((string) $settings[$props['setting']]);
        }
        if (isset($props['active_page'])) {
            unset($attrs['aria-current']);
            if ($props['active_page'] === $this->pageKey) $attrs['aria-current'] = 'page';
        }
        if ($props['contact_email'] ?? false) {
            $block->setBlockContent($email ?: '');
            $attrs['href'] = $email ? 'mailto:' . $email : null;
        }
        $block->setBlockAttributes($attrs);
        $children = [];
        foreach ($block->getBlockChildren() as $key => $child) {
            $when = $child->getBlockDescriptor()->getBlockProps()['when'] ?? null;
            if (($when === 'valid_email' && !$email) || ($when === 'invalid_email' && $email)) continue;
            $this->applyBindings($child, $settings, $email);
            $children[$key] = $child;
        }
        $block->setBlockChildren($children);
    }
}
