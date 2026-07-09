/* Alumni Success Directory — nav behaviour
   Handles: scroll-aware header, mobile drawer open/close,
   outside-click / Escape-key dismissal, and body scroll lock. */
document.addEventListener("DOMContentLoaded", () => {
  const header = document.getElementById("siteHeader");
  const toggle = document.getElementById("navToggle");
  const links = document.getElementById("navLinks");
  const scrim = document.getElementById("navScrim");
  if (!header || !toggle || !links || !scrim) return;

  /* Header gains a stronger glass/shadow treatment once the page scrolls. */
  const onScroll = () => header.classList.toggle("scrolled", window.scrollY > 12);
  onScroll();
  addEventListener("scroll", onScroll, { passive: true });

  const openMenu = () => {
    toggle.classList.add("open");
    toggle.setAttribute("aria-expanded", "true");
    links.classList.add("open");
    scrim.classList.add("open");
    document.documentElement.style.overflow = "hidden";
  };

  const closeMenu = () => {
    toggle.classList.remove("open");
    toggle.setAttribute("aria-expanded", "false");
    links.classList.remove("open");
    scrim.classList.remove("open");
    document.documentElement.style.overflow = "";
  };

  toggle.addEventListener("click", () => {
    links.classList.contains("open") ? closeMenu() : openMenu();
  });

  scrim.addEventListener("click", closeMenu);
  links.querySelectorAll("a").forEach(a => a.addEventListener("click", closeMenu));
  addEventListener("keydown", e => { if (e.key === "Escape") closeMenu(); });

  /* If the drawer is open and the viewport is resized back to desktop
     width, close it so it doesn't get stuck open behind the inline nav. */
  const mq = matchMedia("(min-width: 861px)");
  mq.addEventListener("change", e => { if (e.matches) closeMenu(); });
});