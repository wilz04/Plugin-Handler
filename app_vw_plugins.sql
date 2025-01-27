create view app_vw_plugins as select
	p._id as _id,
	p._url as _url,
	case when s._value is null then 0 else 1 end as _enabled
from app_tb_plugins p
left join app_tb_settings s on s._key = 'home' and s._value = p._id

