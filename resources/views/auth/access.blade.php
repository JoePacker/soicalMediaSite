<script type="text/javascript">
    window.Roles = @json(Auth::check() ? Auth::user()->roles()->pluck('name') : []);
    window.Permissions = @json(Auth::check() ? Auth::user()->permissions()->pluck('name') : []);

    window.can = function (permission) {
        if (Roles.includes('admin')) {
            return true;
        }

        return Permissions.includes(permission);
    }
</script>
