<nav>
    <ul>
        <li><a href="/" <?php if (urlIs("/")) echo "class='current'"?>>home</a></li>
        <li><a href="/create" <?php if (urlIs("/create")) echo "class='current'"?>>create</a></li>
    </ul>
</nav>