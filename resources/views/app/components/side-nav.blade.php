<aside class="menu">
    <div class="user-profile--container">
        <div class="user-profile--avatar">
            <figure class="image is-64x64">
                <img src="https://s.gravatar.com/avatar/{{ hash('md5', user()->email) }}?s=80">
            </figure>
        </div>
        <div class="user-profile--name">
            {{ user()->name }}
        </div>
    </div>
    <ul class="menu-list">
        <li>
            <router-link to="/" exact>Dashboard</router-link>
        </li>
        <li>
            <router-link to="/today">Today</router-link>
        </li>
        <li>
            <router-link to="/habits">Habits</router-link>
        </li>
        <li>
            <router-link to="/progress">Progress</router-link>
        </li>
        <li>
            <router-link to="/history">History</router-link>
        </li>
        <li>
            <form id="logout-form" action="/logout" method="post">
                {{ csrf_field() }}
                <a onclick="document.querySelector('#logout-form').submit(); return false;" href="/logout">Log out</a>
            </form>
        </li>
    </ul>
</aside>