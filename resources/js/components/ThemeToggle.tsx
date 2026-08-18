import { Button, Icon, useTheme, type ThemePreference } from '@particle-academy/react-fancy';

const LABEL: Record<ThemePreference, string> = {
    light: 'Theme: light',
    dark: 'Theme: dark',
    system: 'Theme: system (follows your OS)',
};

const ICON: Record<ThemePreference, string> = {
    light: 'sun',
    dark: 'moon',
    system: 'monitor',
};

/**
 * A three-state theme control: light, dark, and **system**.
 *
 * Two-state toggles are the common shape and they quietly lose something — once
 * a visitor clicks one, "follow my OS" is unreachable for good, because there is
 * no state left to express it. `useTheme` models system as the absence of a
 * stored choice, so it stays reachable.
 *
 * Leaving system steps to the OPPOSITE of what is on screen. Stepping to a fixed
 * first entry looks broken half the time: for a visitor whose OS is already
 * light, "system (light)" and "light" paint the same page and the button appears
 * dead.
 */
export function ThemeToggle() {
    const { preference, resolved, setPreference } = useTheme();

    const next: ThemePreference =
        preference === 'system' ? (resolved === 'dark' ? 'light' : 'dark')
        : preference === 'dark' ? 'light'
        : 'system';

    return (
        <Button
            variant="ghost"
            size="sm"
            aria-label={LABEL[preference]}
            title={LABEL[preference]}
            onClick={() => setPreference(next)}
        >
            <Icon name={ICON[preference]} size="sm" />
        </Button>
    );
}
