<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link ">
        <i class="nav-icon fas fa-home"></i>
        <p> {{__('Главная')}}</p>
    </a>
</li>
<li class="nav-item">

<a href="{{ route('company.view.index') }}" class="nav-link ">
    <i class="nav-icon fas fa-regular fa-building"></i>
    <p> {{__('Компании')}}</p>
</a>
</li>
<li class="nav-item">
<a href="{{ route('client.view.index') }}" class="nav-link">
    <i class="nav-icon fa-regular fa-user"></i>
    <p> {{__('Клиенты')}}</p>
</a>
</li>
