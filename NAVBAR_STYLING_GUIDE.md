# Navbar Styling Reference Guide

## Color Palette

```css
--blue-dark: #003366          /* Primary brand color */
--blue-medium: #1a4a7a        /* Secondary shade */
--gold: #c6a43b               /* Accent color */
--gold-light: #e0c678         /* Light accent for hovers */
--white: #ffffff              /* Text and backgrounds */
--text-light: rgba(255, 255, 255, 0.7)  /* Muted text */
```

## Animation Timings

- **Speed**: 0.3s (all transitions)
- **Timing Function**: cubic-bezier(0.25, 0.46, 0.45, 0.94)
- **Scroll Effect Debounce**: 10ms

## Component Styling

### Navbar States

#### Default State
```
Background: Linear gradient (blue-dark → blue-medium)
Padding: 0.8rem 0
Border-bottom: 2px solid rgba(gold, 0.2)
Shadow: 0 2px 8px rgba(0, 0, 0, 0.1)
```

#### Scrolled State
```
Padding: 0.5rem 0
Shadow: 0 4px 20px rgba(0, 0, 0, 0.15)
Border: Reduced to 1px
Transition: Smooth 0.4s
```

### Logo Styling

#### Logo Image
- Size: 40px height
- Border-radius: 8px
- Default Shadow: 0 2px 8px rgba(0, 0, 0, 0.2)
- Hover:
  - Transform: scale(1.05)
  - Shadow: 0 4px 12px rgba(gold, 0.3)
  - Transition: 0.3s smooth

#### Logo Divider
- Width: 2px (increased from 1px)
- Height: 30px
- Background: Gradient (white fade ↔ gold ↔ white fade)
- Effect: Professional separator appearance

#### Brand Text
- Font-size: 1.4rem
- Font-weight: 700
- Letter-spacing: -0.5px
- Default color: White
- Hover effects:
  - Color: gold-light
  - Text-shadow: 0 0 10px rgba(gold, 0.4)
  - Smooth 0.3s transition

### Navigation Links

#### Active State
```
Color: gold (#c6a43b)
Background: rgba(gold, 0.15)
Border-left: 3px solid gold
Box-shadow: inset 0 2px 8px rgba(gold, 0.1)
```

#### Hover State
```
Color: gold-light (#e0c678)
Transform: translateY(-2px)
Background animation: Slide in from left
Icon scale: 1.15x
```

#### Default State
```
Color: white
Background: transparent
Padding: 0.6rem 1rem
Border-radius: 10px
```

### Dropdown Menus

#### Menu Container
```
Background: rgba(blue-dark, 0.98)
Backdrop-filter: blur(15px)
Border: 1px solid rgba(gold, 0.2)
Border-radius: 12px
Shadow: 0 8px 24px rgba(0, 0, 0, 0.2)
Animation: Slide-in 0.3s cubic-bezier
```

#### Dropdown Items
```
Padding: 10px 20px
Font-size: 0.9rem
Position: relative

Hover Effects:
- Background: rgba(gold, 0.2)
- Color: gold-light
- Transform: translateX(8px)
- Left border: Scales in (3px width)
```

#### Dropdown Toggle Arrow
```
Default: Points down (▼)
Expanded: Rotates 180° (▲)
Transition: 0.3s smooth
```

### Search Form

#### Default State
```
Border: 1px solid rgba(255, 255, 255, 0.3)
Background: rgba(255, 255, 255, 0.08)
Border-radius: 999px
Padding: 0.2rem 0.6rem 0.2rem 0.9rem
Min-width: 140px
```

#### Focus State
```
Border-color: rgba(gold, 0.7)
Background: rgba(255, 255, 255, 0.15)
Box-shadow: 0 0 8px rgba(gold, 0.2)
```

#### Button Hover
```
Color: gold-light
Transform: scale(1.2)
Transition: 0.3s smooth
```

### Language Toggle

#### Default State
```
Background: rgba(blue-medium, 0.8)
Border: 1px solid rgba(255, 255, 255, 0.3)
Border-radius: 50px
Padding: 5px
```

#### Active Button
```
Background: Gradient (gold → gold-light)
Color: blue-dark
Box-shadow: 0 2px 8px rgba(gold, 0.3)
```

#### Inactive Button
```
Background: transparent
Color: white
```

### Footer Styling

#### Section Headings
```
Font-size: 1.1rem
Font-weight: 600
Color: white
Position: relative
Display: inline-block

Underline Animation:
- Starts: 35px width
- On Hover: Expands to 100%
- Bottom: -8px
- Height: 3px
- Color: gold (gradient fade)
- Transition: 0.3s smooth
```

#### Links
```
Default:
- Color: rgba(255, 255, 255, 0.7)
- Text-decoration: none
- Font-size: 0.85rem

Hover:
- Color: gold-light
- Transform: translateX(4px)
- Underline animation (0 → 100%)
```

#### Social Icons
```
Size: 40px × 40px
Border-radius: 50% (circle)
Default background: rgba(255, 255, 255, 0.1)
Border: 1px solid rgba(gold, 0.2)

Hover Effects:
- Background: gold
- Transform: translateY(-4px) scale(1.1)
- Shadow: 0 6px 16px rgba(gold, 0.3)
- Icon color: blue-dark
- Transition: 0.3s smooth
```

### Back-to-Top Button

#### Position
```
Fixed positioning
Bottom: 25px
Right: 25px
```

#### Default State
```
Size: 48px × 48px
Background: Gradient (gold → gold-light)
Color: blue-dark
Border-radius: 50% (circle)
Shadow: 0 4px 16px rgba(gold, 0.3)
Opacity: 0
Visibility: hidden
```

#### Show State (scrollY > 300px)
```
Opacity: 1
Visibility: visible
```

#### Hover State
```
Background: Gradient (white → gold-light)
Transform: translateY(-6px)
Shadow: 0 8px 24px rgba(gold, 0.4)
```

## Responsive Design

### Desktop (≥992px)
- Full navbar with all elements visible
- Horizontal navigation menu
- Search and language toggle inline
- All hover effects enabled

### Tablet (≤991px)
- Vertical navbar collapse at 991px
- Mobile menu with centered items
- Active state: bottom border (instead of left)
- Full-width navigation items
- Search form below menu

### Mobile (≤768px)
- Reduced logo sizes
- Compact navbar
- Optimized padding
- Touch-friendly spacing

### Small Mobile (≤576px)
- Logo: 28px height
- Extra-small font sizes
- Tighter padding
- Minimal spacing

### Extra Small (≤360px)
- Logo: 24px height
- Ultra-responsive sizing
- Optimized for narrow screens

## Animation Keyframes

### Dropdown Slide-In
```css
@keyframes dropdownSlideIn {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
```

## CSS Custom Properties Usage

```css
/* Apply transition speed */
transition: all var(--transition-speed) var(--transition-timing);

/* Use color variables */
color: var(--gold);
background: rgba(var(--blue-dark), 0.95);

/* Consistent spacing */
gap: 1rem;
padding: 0.6rem 1rem;
```

## JavaScript Interactions

### Navbar Scroll Detection
- Triggers every 10ms (debounced)
- Adds 'scrolled' class when scrollY > 50px
- Smooth transition on class toggle

### Mobile Menu Auto-Close
- Closes when navigation link clicked
- Only on devices < 992px
- Uses Bootstrap Collapse API

### Active Link Highlighting
- Detects current URL pathname
- Applies 'active' class automatically
- No page reload required

### Language Persistence
- Stores selected language in localStorage
- Restores on page reload
- Smooth language switching

### Dropdown Enhancement
- Prevents default link behavior
- Triggers animation on click
- Smooth open/close animation

## Best Practices Applied

✅ **CSS Architecture**
- Organized sections with comments
- Logical grouping of related styles
- Consistent naming conventions

✅ **Performance**
- Hardware-accelerated transforms
- Debounced scroll listeners
- Optimized animations

✅ **Accessibility**
- ARIA attributes on interactive elements
- Keyboard navigation support
- High contrast ratios

✅ **Responsiveness**
- Mobile-first approach
- 5 breakpoints for coverage
- Flexible sizing and spacing

✅ **Maintainability**
- CSS custom properties for theming
- Clear variable names
- Well-documented sections

## Testing Checklist

- ✅ Desktop view (1920px+)
- ✅ Tablet view (768px - 991px)
- ✅ Mobile view (375px - 767px)
- ✅ Small mobile (320px - 374px)
- ✅ All hover states working
- ✅ All animations smooth
- ✅ Mobile menu closing properly
- ✅ Search form functional
- ✅ Language toggle working
- ✅ Back-to-top button responsive
- ✅ Footer links animating
- ✅ Dropdowns opening/closing smoothly
- ✅ Active links highlighting correctly
- ✅ No horizontal scrolling
- ✅ Keyboard navigation working

---

This guide provides a complete reference for understanding and maintaining the navbar styling system.
